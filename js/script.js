
function getTasks() {
    fetch('task.php')
        .then(response => {
            return response.text();
        })
        .then(text => {
            console.log(text);
        })
        .catch(err => {
            console.error('erreur fetch : ' + err);
        });
}

getTasks();

const mybtn = document.querySelector('#mybtn');

mybtn.addEventListener('click', getTasks);