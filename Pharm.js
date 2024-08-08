const allSideMenu = document.querySelectorAll('.sidebar .side-menu li a');

allSideMenu.forEach(item => {
  const li = item.parentElement;

  item.addEventListener('click', function() {
    // Remove 'active' class from all menu items
    allSideMenu.forEach(i => i.parentElement.classList.remove('active'));
    // Add 'active' class to the clicked menu item
    li.classList.add('active');
  });
});


document.addEventListener("DOMContentLoaded", function() {
  const notificationIcon = document.querySelector('#content nav .notification i.bxs-bell');
  const notification = document.querySelector('#content nav .notification');

  notification.addEventListener('mouseover', function() {
      notificationIcon.classList.add('bx-tada');
  });

  notification.addEventListener('mouseout', function() {
      notificationIcon.classList.remove('bx-tada');
  });
});


const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.querySelector('.sidebar');

menuBar.addEventListener('click', function() {
  sidebar.classList.toggle('hide');
});

/*
document.addEventListener("DOMContentLoaded", function() {
  const menuBar = document.querySelector('#content nav .bx.bx-menu');
  const sidebar = document.querySelector('.sidebar');

  menuBar.addEventListener('click', function() {
      if (sidebar.classList.contains('hide') when minized) {
          alert('Maximize Page to enable function');
      }
      sidebar.classList.toggle('hide');
  });
});*/


// Query ---- for ---- userFirstname---
function fetchFirstName() {
  return new Promise((resolve, reject) => {
    // Simulating an asynchronous operation (e.g., database or API call)
    setTimeout(() => {
      const firstName = "Joe"; // The database userFirstname cln.
      resolve(firstName);
    }, 1000);
  });
}

/*userFirstname Display
window.onload = async function() {
  try {
    const firstName = await fetchFirstName();
    const firstNameElement = document.getElementById("firstName");
    if (firstNameElement) {
      firstNameElement.textContent = firstName;
    } else {
      console.error('Element with id "firstName" not found');
    }
  } catch (error) {
    console.error('Error fetching the user\'s first name:', error);
  }
};

TESTER = document.getElementById('tester');
	Plotly.newPlot( TESTER, [{
	x: [1, 2, 3, 4, 5],
	y: [1, 2, 4, 8, 16] }], {
	margin: { t: 0 } } );
  */