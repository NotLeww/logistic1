let projects = [
  // Sample data
  {
    projectName: "Site A Expansion",
    item: "Steel Beams",
    status: "In Transit",
    assignedTo: "Driver 1",
    milestone: "Phase 1 Delivery",
    remarks: "On schedule"
  }
];

let editIndex = null;

function renderProjects() {
  const tbody = document.querySelector('.project-table tbody');
  tbody.innerHTML = '';
  projects.forEach((proj, idx) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${proj.projectName}</td>
      <td>${proj.item}</td>
      <td>${proj.status}</td>
      <td>${proj.assignedTo}</td>
      <td>${proj.milestone}</td>
      <td>${proj.remarks}</td>
      <td>
        <button onclick="openEditProjectModal(${idx})">Edit</button>
      </td>
    `;
    tbody.appendChild(row);
  });
}

function openProjectModal() {
  editIndex = null;
  document.querySelector('#projectModal h3').textContent = "Add Project Delivery";
  const inputs = document.querySelectorAll('#projectModal input, #projectModal select');
  inputs[0].value = '';
  inputs[1].value = '';
  inputs[2].value = '';
  inputs[3].value = '';
  inputs[4].value = 'Pending';
  inputs[5].value = '';
  document.getElementById('projectModal').style.display = 'block';
}

function openEditProjectModal(idx) {
  editIndex = idx;
  document.querySelector('#projectModal h3').textContent = "Edit Project Delivery";
  const proj = projects[idx];
  const inputs = document.querySelectorAll('#projectModal input, #projectModal select');
  inputs[0].value = proj.projectName;
  inputs[1].value = proj.item;
  inputs[2].value = proj.assignedTo;
  inputs[3].value = proj.milestone;
  inputs[4].value = proj.status;
  inputs[5].value = proj.remarks;
  document.getElementById('projectModal').style.display = 'block';
}

function closeProjectModal() {
  document.getElementById('projectModal').style.display = 'none';
}

document.querySelector('#projectModal form').onsubmit = function(e) {
  e.preventDefault();
  const inputs = document.querySelectorAll('#projectModal input, #projectModal select');
  const newProject = {
    projectName: inputs[0].value,
    item: inputs[1].value,
    assignedTo: inputs[2].value,
    milestone: inputs[3].value,
    status: inputs[4].value,
    remarks: inputs[5].value
  };
  if (editIndex === null) {
    projects.push(newProject);
  } else {
    projects[editIndex] = newProject;
  }
  closeProjectModal();
  renderProjects();
};

document.addEventListener('DOMContentLoaded', renderProjects);