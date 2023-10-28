/*console.log('ok')

const btn_delete = document.querySelectorAll(".btn-delete");
const btn_edit = document.querySelectorAll(".btn-edit");

function deleteTache() {
    btn_delete.forEach(element => {
        //console.log(element)
        element.addEventListener('click', (e) => {
            e.preventDefault()
            const idTache = element.getAttribute("data-id");
            const params = `http://localhost/projet_1_todo/todo/deleteTodo/${idTache}`;
            fetch(params, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                },
            })
                .then((resp) => {
                    if (resp.status === 200) {
                        location.reload();
                    }
                })
        })
    });
}
deleteTache();

*/