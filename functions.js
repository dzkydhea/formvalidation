const form = document.getElementById('form');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const userTable = document.getElementById('userTable').getElementsByTagName('tbody')[0];

let users = JSON.parse(localStorage.getItem('users')) || [];

function renderTable() {
  userTable.innerHTML = '';
  users.forEach((user, index) => {
    const row = userTable.insertRow();
    row.insertCell(0).textContent = user.name;
    row.insertCell(1).textContent = user.email;
    const actionsCell = row.insertCell(2);
    actionsCell.innerHTML = `
      <button class="edit" onclick="editUser(${index})">Edit</button>
      <button class="delete" onclick="deleteUser(${index})">Delete</button>
    `;
  });
}

function saveToLocalStorage() {
  localStorage.setItem('users', JSON.stringify(users));
}

function addUser() {
  const name = nameInput.value.trim();
  const email = emailInput.value.trim();
  if (name && email) {
    users.push({ name, email });
    saveToLocalStorage();
    renderTable();
    nameInput.value = '';
    emailInput.value = '';
  }
}

function editUser(index) {
  const user = users[index];
  nameInput.value = user.name;
  emailInput.value = user.email;
  form.onsubmit = () => updateUser(index);
}

function updateUser(index) {
  const name = nameInput.value.trim();
  const email = emailInput.value.trim();
  if (name && email) {
    users[index] = { name, email };
    saveToLocalStorage();
    renderTable();
    nameInput.value = '';
    emailInput.value = '';
    form.onsubmit = addUser;
  }
}

function deleteUser(index) {
  if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
    users.splice(index, 1);
    saveToLocalStorage();
    renderTable();
  }
}

form.onsubmit = addUser;
renderTable();
