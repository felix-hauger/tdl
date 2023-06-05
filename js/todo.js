(async () => {

    async function getTasks() {
        let request = await fetch('tasks.php');

        let json = await request.json();
        console.log(json);

        console.log('get');

        const addedTmp = new DocumentFragment(), // Temporary are to sort tasks by category and add operations on them
            completedTmp = new DocumentFragment(), // Then are appended to task containers in DOM
            added = document.querySelector('#tofinish .tasks-container'), // These are to display in html
            completed = document.querySelector('#achieved .tasks-container'); // Added and completed tasks

        for (const task of json) {
            let category; // Added or completed, to append tasks to te DocumentFragment const

            const taskBox = document.createElement('form'),
                deleteBtn = document.createElement('button'), // All tasks can be deleted
                content = document.createElement('p'),
                displayedDate = document.createElement('span');

            content.innerHTML = task.content;
            deleteBtn.innerHTML = 'Supprimer';

            displayedDate.classList.add('displayed-date');

            taskBox.classList.add('task');
            taskBox.setAttribute('id', 'task-' + task.id);
            taskBox.setAttribute('method', 'post');

            deleteBtn.classList.add('delete-task');
            deleteBtn.setAttribute('type', 'submit');
            deleteBtn.setAttribute('name', 'delete');
            deleteBtn.setAttribute('value', task.id);
            deleteBtn.addEventListener('click', event => {
                event.preventDefault();

                const formData = new FormData();

                formData.append('delete', deleteBtn.value);

                fetch('delete.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        return response.text();
                    })
                    .then(data => {
                        console.log(data);
                        getTasks();
                    })
                    .catch(err => {
                        console.error('erreur suppression tâche : ' + err);
                    });
            });

            taskBox.append(content);

            // If task has no completion_date, it is not completed
            if (task.completion_date === null) {
                // code for non completed tasks

                category = addedTmp; // To link added task to addedTmp DocumentFragment

                // Non completed tasks must have a "finish" button
                const finishBtn = document.createElement('button');

                finishBtn.classList.add('finish-task');
                finishBtn.setAttribute('type', 'submit');
                finishBtn.setAttribute('name', 'finish');
                finishBtn.setAttribute('value', task.id);
                finishBtn.addEventListener('click', event => {
                    event.preventDefault();

                    const formData = new FormData();

                    formData.append('finish',  finishBtn.value);

                    fetch('complete.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => {
                            return response.text();
                        })
                        .then(data => {
                            console.log(data);
                            getTasks();
                        })
                        .catch(err => {
                            console.error('erreur de complétion : ' + err);
                        })
                });

                displayedDate.innerHTML = 'ajouté ' + task.creation_date;
                finishBtn.innerHTML = 'Terminer';

                taskBox.append(displayedDate);
                taskBox.append(finishBtn);
            } else {
                // Code for completed tasks

                category = completedTmp; // To link completed task to completedTmp DocumentFragment

                displayedDate.innerHTML = 'terminé ' + task.completion_date;

                taskBox.append(displayedDate);
            }

            taskBox.append(deleteBtn);

            category.append(taskBox); // Append task to defined category, depending if completion_date is null or not
        }

        added.innerHTML = '';
        completed.innerHTML = '';
        added.append(addedTmp);
        completed.append(completedTmp);
    }

    await getTasks();

    function addTask() {
        const form = document.querySelector('#add-task'),
            formData = new FormData(form);

        fetch('add.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                return response.text();
            })
            .then(data => {
                console.log(data);
                document.querySelector('#content').value = '';
                getTasks();
            })
            .catch(err => {
                console.error('erreur création : ' + err);
            });
    }

    const add = document.querySelector('#add-task');

    add.addEventListener('submit', (event) => {
        event.preventDefault();
        addTask();
    });
})();
