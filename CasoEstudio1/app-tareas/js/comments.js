// comments.js

document.addEventListener('DOMContentLoaded', function () {
    const infoComentarios = {}; // almaceno los comentarios de cada tarea

    // llaama la carga de comentarios
    function loadComments(taskId) {
        const comentariosContainer = document.getElementById(`comments-${taskId}`);
        comentariosContainer.innerHTML = ''; // Limpiar contenido previo

        (infoComentarios[taskId] || []).forEach((comment, index) => {
            const comentarioItem = document.createElement('li');
            comentarioItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            comentarioItem.innerHTML = `
                <span>${comment}</span>
                <button class="btn btn-danger btn-sm delete-comment" data-task-id="${taskId}" data-comment-index="${index}">Eliminar</button>
            `;
            comentariosContainer.appendChild(comentarioItem);
        });

        document.querySelectorAll(`.delete-comment[data-task-id="${taskId}"]`).forEach(button => {
            button.addEventListener('click', handleDeleteComment);
        });
    }
// proceso para agregar comentarui 
    function handleAddComment(event) {
        const taskId = event.target.dataset.taskId;
        const inputcomentario = document.getElementById(`comment-input-${taskId}`);
        const textocomentario = inputcomentario.value.trim();

        if (textocomentario) {
            if (!infoComentarios[taskId]) infoComentarios[taskId] = [];
            infoComentarios[taskId].push(textocomentario);
            inputcomentario.value = '';
            loadComments(taskId);
        }
    }

    // eliminar el comentario
    function handleDeleteComment(event) {
        const taskId = event.target.dataset.taskId;
        const commentIndex = event.target.dataset.commentIndex;
        
        infoComentarios[taskId].splice(commentIndex, 1);
        loadComments(taskId);
    }

    //  funcion para agregar comentarios a las tareas
    window.agregarComenrariosTareas = function(taskId) {
        const taskCard = document.querySelector(`[data-task-id="${taskId}"]`);
        const comentarioSection = document.createElement('div');
        comentarioSection.className = 'mt-3';

        comentarioSection.innerHTML = `
            <h6>Comentarios</h6>
            <ul id="comments-${taskId}" class="list-group mb-3"></ul>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Agregar comentario" id="comment-input-${taskId}">
                <button class="btn btn-primary add-comment" data-task-id="${taskId}">Añadir</button>
            </div>
        `;
        taskCard.appendChild(comentarioSection);

        document.querySelector(`.add-comment[data-task-id="${taskId}"]`).addEventListener('click', handleAddComment);
        loadComments(taskId);
    };
});
