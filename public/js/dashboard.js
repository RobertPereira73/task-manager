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
    loadCount();
}

function sortPositions(show=true) {
    let containers = document.querySelectorAll('.tasks-container .task-list');
    containers.forEach((container) => {
        !show 
            ? container.classList.remove('show')
            : container.classList.add('show');
    })
}

function searchTask(value='') {
    $('.task-list .task').addClass('hiden');
    
    if (!value) {
        $('.task-list .task').removeClass('hiden');
        loadCount();
        return;
    }

    $(`
        .task-list .task:has(.title:contains(${value})),
        .task-list .task:has(.description:contains(${value}))`
    ).removeClass('hiden');

    loadCount();
}

function loadCount() {
    let lists = document.querySelectorAll('.tasks-container .task-list');
    lists.forEach(list => {
        let count = list.querySelectorAll('.task:not(.hiden)');
        list.closest('.tasks-container').querySelector('.task-count').innerHTML = count.length;
    });
}

$( function() {
    document.querySelector('#search').addEventListener('keyup', (event) => {
        let string = event.target.value;
        string = string.toLowerCase();

        searchTask(string);
    })

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

    $(`
        #to-doSortable,
        #doingSortable, 
        #doneSortable
    `).on( "sortstart", () => sortPositions());

    $(`
        #to-doSortable,
        #doingSortable, 
        #doneSortable
    `).on( "sortstop", () => sortPositions(false));
});