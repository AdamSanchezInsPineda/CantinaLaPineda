document.getElementById('searchInput').addEventListener('input', function() {
    let searchTerm = this.value.toLowerCase();
    let users = document.querySelectorAll('.user-item');

    users.forEach(function(user) {
        let userName = user.querySelector('b').textContent.toLowerCase();
        
        if (userName.includes(searchTerm)) {
            user.style.display = '';
        } else {
            user.style.display = 'none';
        }
    });
});