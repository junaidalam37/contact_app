document.addEventListener("DOMContentLoaded", () => {
  // Sidebar Navigation
  const links = document.querySelectorAll('.sidebar ul a');
  const sections = document.querySelectorAll('.content-section');

  links.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      links.forEach(item => item.classList.remove('active'));
      link.classList.add('active');

      const target = link.getAttribute('data-section');
      sections.forEach(section => {
        section.id === target ? section.classList.add('active') : section.classList.remove('active');
      });
    });
  });

  // Edit Modal Logic - Added Below
  // Highlight: Functions to open and close the edit modal
  // Function to open the modal and populate it with data
  window.openEditModal = (contact, email, name) => { 
    const modal = document.getElementById('editModal'); // Select the modal element
    modal.style.display = 'block'; // Make the modal visible

    // Populate the input fields in the modal with provided data
    document.getElementById('modal-name').value = name;
    document.getElementById('modal-phone').value = contact;
    document.getElementById('modal-email').value = email;
    document.getElementById('modal-contact-number').value = contact;
  };

  // Function to close the modal
  window.closeEditModal = () => {
    const modal = document.getElementById('editModal'); // Select the modal element
    modal.style.display = 'none'; // Hide the modal
  };

  // Highlight: Close modal when clicking outside of it
  window.addEventListener('click', e => {
    const modal = document.getElementById('editModal');
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
});






// document.addEventListener("DOMContentLoaded", () => {
//     const links = document.querySelectorAll('.sidebar ul a');
//     const sections = document.querySelectorAll('.content-section');
  
//     links.forEach(link => {
//       link.addEventListener('click', e => {
//         e.preventDefault();
//         links.forEach(item => item.classList.remove('active'));
//         link.classList.add('active');
  
//         const target = link.getAttribute('data-section');
//         sections.forEach(section => {
//           section.id === target ? section.classList.add('active') : section.classList.remove('active');
//         });
//       });
//     });
//   });
  // function openEditModel(contactId, email,name){
  //   document.getElementById("model-contact-number").value = contactId;
  //   document.getElementById("model-name").value = name;
  //   document.getElementById("model-phone").value = contactId;
  //   document.getElementById("model-email").value = email;
  //   document.getElementById("editModel").style.display="flix";


  // }
  // function closedEditModel(){
  //   document.getElementById("editModel").style.display="none";
  // }