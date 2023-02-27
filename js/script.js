
function getTasks() {
    fetch('task.php')
        .then(response => {
            return response.json();
        })
        .then(json => {
            console.log(json);
            for (const task of json) {
                let container;
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
                    // code pour tâche inachevées
                    // console.log(task)
                    const finishBtn = document.createElement('button');
                    container = document.querySelector('#tofinish .task-container');

                    displayedDate.innerHTML = 'ajouté le ' + task.creation_date;
                    finishBtn.innerHTML = 'Terminer';

                    taskBox.append(displayedDate);
                    taskBox.append(finishBtn);
                } else {
                    // code pour tâches achevées
                    displayedDate.innerHTML = 'terminé le ' + task.completion_date;
                    container = document.querySelector('#achieved .task-container');

                    taskBox.append(displayedDate);
                }

                taskBox.append(deleteBtn);
                container.append(taskBox);
            }
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