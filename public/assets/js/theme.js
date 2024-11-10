// Toggle the cart dropdown
function toggleCartDropdown() {
  const cartDropdown = document.getElementById('cartDropdown');
  
  if (cartDropdown.style.display === 'none' || cartDropdown.style.display === '') {
    closeDropdowns(); // Close other dropdowns
    cartDropdown.style.display = 'block';
  } else {
    cartDropdown.style.display = 'none';
  }
}

// Function to close both dropdowns
function closeDropdowns() {
  const cartDropdown = document.getElementById('cartDropdown');
  cartDropdown.style.display = 'none';
  
  // Check if the user dropdown exists before attempting to close it
  const userDropdown = document.getElementById('userDropdown');
  if (userDropdown) {
    const userDropdownMenu = userDropdown.nextElementSibling;
    if (userDropdownMenu && userDropdownMenu.classList.contains('show')) {
      userDropdown.click(); // Close user dropdown
    }
  }
}

// Close Cart dropdown when clicking on the User dropdown
const userDropdown = document.getElementById('userDropdown');
if (userDropdown) {
  userDropdown.addEventListener('click', () => {
    const cartDropdown = document.getElementById('cartDropdown');
    if (cartDropdown) {
      cartDropdown.style.display = 'none';
    }
  });
}

// Close dropdowns when clicking outside
document.addEventListener('click', (event) => {
  const cartDropdown = document.getElementById('cartDropdown');
  const userDropdownMenu = document.querySelector('.dropdown-menu');
  
  // Check if userDropdownMenu exists and handle click outside logic
  if (!event.target.closest('.btn') && !event.target.closest('.dropdown-toggle') && 
      !event.target.closest('.dropdown-menu')) {
    
    if (cartDropdown) {
      cartDropdown.style.display = 'none';
    }

    if (userDropdownMenu && userDropdownMenu.classList.contains('show')) {
      userDropdownMenu.classList.remove('show');
    }
  }
});