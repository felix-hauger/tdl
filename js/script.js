
function getTasks() {
    fetch('task.php')
        .then(response => {
            return response.json();
        })
        .then(json => {
            console.log(json);
            for (const task of json) {
                if (task.completion_date === null) {
                    console.log(task)
                    // code pour tâche inachevées

                } else {
                    // code pour tâches achevées
                    
                }
            }
        })
        .catch(err => {
            console.error('erreur fetch : ' + err);
        });
}

// getTasks();

const mybtn = document.querySelector('#mybtn');

mybtn.addEventListener('click', getTasks);