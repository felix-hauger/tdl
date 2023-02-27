
function getTasks() {
    fetch('task.php')
        .then(response => {
            return response.json();
        })
        .then(json => {
            console.log(json);
            // using DocumentFragment?
            const addedTmp = new DocumentFragment(),
                completedTmp = new DocumentFragment(),
                added = document.querySelector('#tofinish .task-container'),
                completed = document.querySelector('#achieved .task-container');

            for (const task of json) {
                let category; // finished or non finished
                const taskBox = document.createElement('div'),
                    deleteBtn = document.createElement('button'),
                    content = document.createElement('b'),
                    displayedDate = document.createElement('span');

                content.innerHTML = task.content;
                deleteBtn.innerHTML = 'Supprimer';
                console.log(task);
                deleteBtn.setAttribute('id', 'task-' + task.id);

                taskBox.append(content);

                if (task.completion_date === null) {
                    // code for finished tasks
                    // console.log(task)
                    const finishBtn = document.createElement('button');
                    // container = document.querySelector('#tofinish .task-container');
                    category = addedTmp;

                    displayedDate.innerHTML = 'ajouté le ' + task.creation_date;
                    finishBtn.innerHTML = 'Terminer';

                    taskBox.append(displayedDate);
                    taskBox.append(finishBtn);
                } else {
                    // code for non finished tasks
                    displayedDate.innerHTML = 'terminé le ' + task.completion_date;
                    // container = document.querySelector('#achieved .task-container');
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
        })
        .catch(err => {
            console.error('erreur fetch : ' + err);
        });
}

getTasks();

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
};

add.addEventListener('submit', (event) => {
    event.preventDefault();
    addTask();
})

// mybtn.addEventListener('click', getTasks);