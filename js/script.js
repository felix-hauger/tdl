(async () => {

    async function getTasks() {
        let request = await fetch('task.php');
        let json = await request.json();
        console.log(json);


        const addedTmp = new DocumentFragment(),
            completedTmp = new DocumentFragment(),
            added = document.querySelector('#tofinish .task-container'),
            completed = document.querySelector('#achieved .task-container');

        for (const task of json) {
            let category; // finished or non finished
            const taskBox = document.createElement('form'),
                deleteBtn = document.createElement('button'),
                content = document.createElement('b'),
                displayedDate = document.createElement('span');

            content.innerHTML = task.content;
            deleteBtn.innerHTML = 'Supprimer';

            // console.log(task);

            taskBox.setAttribute('id', 'task-' + task.id);
            taskBox.setAttribute('method', 'post');

            deleteBtn.setAttribute('type', 'submit');
            deleteBtn.setAttribute('name', 'delete');
            deleteBtn.setAttribute('class', 'delete');
            deleteBtn.setAttribute('value', task.id);
            deleteBtn.setAttribute('id', task.id);

            taskBox.append(content);

            if (task.completion_date === null) {
                // code for finished tasks
                const finishBtn = document.createElement('button');
                finishBtn.setAttribute('type', 'submit');
                finishBtn.setAttribute('name', 'finish');
                finishBtn.setAttribute('class', 'finish');
                finishBtn.setAttribute('value', task.id);
                category = addedTmp;

                displayedDate.innerHTML = 'ajouté le ' + task.creation_date;
                finishBtn.innerHTML = 'Terminer';

                taskBox.append(displayedDate);
                taskBox.append(finishBtn);
            } else {
                // code for non finished tasks
                displayedDate.innerHTML = 'terminé le ' + task.completion_date;
                category = completedTmp;

                taskBox.append(displayedDate);
            }

            taskBox.append(deleteBtn);
            category.append(taskBox);
        }


        added.innerHTML = '';
        completed.innerHTML = '';
        added.append(addedTmp);
        completed.append(completedTmp);

        // await fetch('task.php')
        //     .then(response => {
        //         return response.json();
        //     })
        //     .then(json => {
        //         // console.log(json);
        //         // using DocumentFragment?
        //         const addedTmp = new DocumentFragment(),
        //             completedTmp = new DocumentFragment(),
        //             added = document.querySelector('#tofinish .task-container'),
        //             completed = document.querySelector('#achieved .task-container');

        //         for (const task of json) {
        //             let category; // finished or non finished
        //             const taskBox = document.createElement('form'),
        //                 deleteBtn = document.createElement('button'),
        //                 content = document.createElement('b'),
        //                 displayedDate = document.createElement('span');

        //             content.innerHTML = task.content;
        //             deleteBtn.innerHTML = 'Supprimer';

        //             // console.log(task);

        //             taskBox.setAttribute('id', 'task-' + task.id);
        //             taskBox.setAttribute('method', 'post');

        //             deleteBtn.setAttribute('type', 'submit');
        //             deleteBtn.setAttribute('name', 'delete');
        //             deleteBtn.setAttribute('class', 'delete');
        //             deleteBtn.setAttribute('value', task.id);

        //             taskBox.append(content);

        //             if (task.completion_date === null) {
        //                 // code for finished tasks
        //                 const finishBtn = document.createElement('button');
        //                 finishBtn.setAttribute('type', 'submit');
        //                 finishBtn.setAttribute('name', 'finish');
        //                 finishBtn.setAttribute('class', 'finish');
        //                 finishBtn.setAttribute('value', task.id);
        //                 category = addedTmp;

        //                 displayedDate.innerHTML = 'ajouté le ' + task.creation_date;
        //                 finishBtn.innerHTML = 'Terminer';

        //                 taskBox.append(displayedDate);
        //                 taskBox.append(finishBtn);
        //             } else {
        //                 // code for non finished tasks
        //                 displayedDate.innerHTML = 'terminé le ' + task.completion_date;
        //                 category = completedTmp;

        //                 taskBox.append(displayedDate);
        //             }

        //             taskBox.append(deleteBtn);
        //             category.append(taskBox);
        //         }


        //         added.innerHTML = '';
        //         completed.innerHTML = '';
        //         added.append(addedTmp);
        //         completed.append(completedTmp);
        //         const deleteBtns = document.querySelectorAll('.delete');

        //         console.log(deleteBtns);
        //     })
        //     .catch(err => {
        //         console.error('erreur fetch : ' + err);
        //     });
    }

   await getTasks();

    const mybtn = document.querySelector('#mybtn');
    const add = document.querySelector('#add-task');

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
                getTasks();
            })
            .catch(err => {
                console.error('erreur création : ' + err);
            });
    }





    // console.log(deleteBtns);

    add.addEventListener('submit', (event) => {
        event.preventDefault();
        addTask();
    });

})()


// mybtn.addEventListener('click', getTasks);