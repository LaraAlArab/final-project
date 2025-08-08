const taskInput = document.getElementById('taskInput');
const addTaskBtn = document.getElementById('addTask');
const taskList = document.getElementById('taskList');
const themeToggle = document.getElementById('themeToggle');

function createTaskElement(text) {
  const li = document.createElement('li');
  li.className = 'task';

  const checkbox = document.createElement('input');
  checkbox.type = 'checkbox';

  const span = document.createElement('span');
  span.textContent = text;

  const editBtn = document.createElement('button');
  editBtn.textContent = 'Edit';

  const deleteBtn = document.createElement('button');
  deleteBtn.textContent = 'Delete';

  const buttonGroup = document.createElement('div');
  buttonGroup.className = 'task-buttons';
  buttonGroup.appendChild(editBtn);
  buttonGroup.appendChild(deleteBtn);

  checkbox.addEventListener('change', () => {
    li.classList.toggle('completed', checkbox.checked);
  });

  editBtn.addEventListener('click', () => {
    if (editBtn.textContent === 'Edit') {
      const input = document.createElement('input');
      input.type = 'text';
      input.value = span.textContent;
      input.className = 'edit-input';
      li.replaceChild(input, span);
      input.focus();
      editBtn.textContent = 'Save';

      input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
          span.textContent = input.value.trim();
          li.replaceChild(span, input);
          editBtn.textContent = 'Edit';
        }
      });
    } else {
      const input = li.querySelector('input[type="text"]');
      span.textContent = input.value.trim();
      li.replaceChild(span, input);
      editBtn.textContent = 'Edit';
    }
  });

  deleteBtn.addEventListener('click', () => {
    const confirmDelete = confirm("Are you sure you want to delete?");
    if (confirmDelete) {
      taskList.removeChild(li);
    }
  });

  li.appendChild(checkbox);
  li.appendChild(span);
  li.appendChild(buttonGroup);

  return li;
}

function addTask() {
  const text = taskInput.value.trim();
  if (text === '') {
    alert("No tasks added!");
    return;
  }
  const taskElement = createTaskElement(text);
  taskList.appendChild(taskElement);
  taskInput.value = '';
}

addTaskBtn.addEventListener('click', addTask);

taskInput.addEventListener('keypress', (e) => {
  if (e.key === 'Enter') {
    addTask();
  }
});

themeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
});
