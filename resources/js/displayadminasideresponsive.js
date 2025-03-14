document.getElementById('toggle-btn').addEventListener('click', function() {
    const adminAside = document.getElementById('admin-aside');
    
    adminAside.classList.toggle('hidden');
    adminAside.classList.add('fixed', 'top-0', 'left-0', 'z-50');
});

document.getElementById('hide-btn').addEventListener('click', function() {
    const adminAside = document.getElementById('admin-aside');
    
    adminAside.classList.toggle('hidden');
    adminAside.classList.remove('fixed', 'top-0', 'left-0', 'z-50');
});