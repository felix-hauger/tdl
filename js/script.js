
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
                    content = document.createElement('p');

                content.innerHTML = task.content;
                deleteBtn.innerHTML = 'Supprimer';
                // deleteBtn.id = 'task' . task.id;
                deleteBtn.setAttribute('id', 'task-' . task.id)

                taskBox.append(content);

                if (task.completion_date === null) {
                    console.log(task)
                    // code pour tâche inachevées
                    const finishBtn = document.createElement('button');
                    finishBtn.innerHTML = 'Terminer';
                    container = document.querySelector('#tofinish .task-container');
                    taskBox.append(finishBtn);
                } else {
                    // code pour tâches achevées
                    container = document.querySelector('#achieved .task-container');
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

// mybtn.addEventListener('click', getTasks);