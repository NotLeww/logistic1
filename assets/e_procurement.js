let requests = [
  // Sample data
  { id: 1, item: "Printer Ink", requestedBy: "Juan Dela Cruz", date: "2025-08-19", status: "Pending", supplier: "ABC Supplies", quantity: 2 }
];

function renderRequests() {
  const tbody = document.querySelector('.procurement-table tbody');
  tbody.innerHTML = '';
  requests.forEach((req, idx) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${req.id}</td>
      <td>${req.item}</td>
      <td>${req.requestedBy}</td>
      <td>${req.date}</td>
      <td>${req.status}</td>
      <td>
        <button onclick="approveRequest(${idx})">Approve</button>
        <button onclick="rejectRequest(${idx})">Reject</button>
      </td>
    `;
    tbody.appendChild(row);
  });
}

function openRequestModal() {
  document.querySelectorAll('#requestModal input').forEach(input => input.value = '');
  document.getElementById('requestModal').style.display = 'block';
}

function closeRequestModal() {
  document.getElementById('requestModal').style.display = 'none';
}

document.querySelector('#requestModal form').onsubmit = function(e) {
  e.preventDefault();
  const inputs = document.querySelectorAll('#requestModal input');
  const newRequest = {
    id: requests.length + 1,
    item: inputs[0].value,
    quantity: parseInt(inputs[1].value),
    supplier: inputs[2].value,
    requestedBy: "Current User", // Replace with actual user
    date: new Date().toISOString().slice(0,10),
    status: "Pending"
  };
  requests.push(newRequest);
  closeRequestModal();
  renderRequests();
};

function approveRequest(idx) {
  requests[idx].status = "Approved";
  renderRequests();
}

function rejectRequest(idx) {
  requests[idx].status = "Rejected";
  renderRequests();
}

document.addEventListener('DOMContentLoaded', renderRequests);