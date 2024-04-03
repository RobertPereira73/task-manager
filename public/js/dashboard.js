async function saveTask(event) {
    event.preventDefault();

    let form = event.target;
    let response = await getFormResponse(form);

    if (response) {
        window.location.reload();
    }
}

async function deleteTask(event) {
    event.preventDefault();

    let form = event.target;
    let response = await getFormResponse(form);

    if (response) {
        removeTask(form);
    }
}

async function updateStatusTask(tasksList, task) {
    let status = tasksList.closest('.tasks-container').dataset.tasktype;
    let id = task.dataset.id;
    
    let formData = new FormData();
    formData.append('status', status)
    formData.append('id', id)

    let config = configObj('POST', formData);
    await sendData('/dashboard/update-status-task', config);
    
    loadCount();
}

function modalTask(task=null) {
    cleanInputs();

    if (task) {
        fillInputs(task);
    }

    $('#save-task').modal('show')
}

function cleanInputs() {
    let inputList = taskInputs();
    inputList.forEach(input => input.value = '');
}

function fillInputs(task) {
    let inputList = taskInputs();
    inputList.forEach(input => input.value = task[input.name]);
}

function taskInputs() {
    return document.querySelectorAll('#save-task form input');
}

function removeTask(form) {
    let taskElement = form.closest('.task');
    taskElement.remove();
}

function loadCount() {
    let lists = document.querySelectorAll('.tasks-container .task-list');
    lists.forEach(list => {
        let count = list.querySelectorAll('li.task');
        list.closest('.tasks-container').querySelector('.task-count').innerHTML = count.length;
    });
}

$( function() {
    $(`
        #to-doSortable,
        #doingSortable, 
        #doneSortable
    `).sortable({
      connectWith: ".task-list"
    });

    $(`
        #to-doSortable,
        #doingSortable, 
        #doneSortable
    `).on('sortreceive', (event, ui) => updateStatusTask(event.target, ui.item[0]))
});