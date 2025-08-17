function toggleSidebar() {
    const nav = document.querySelector('nav');
    const container = document.querySelector('.container');
    const notification = document.querySelector('.notification');

    nav.classList.toggle('collapsed');
    container.classList.toggle('collapsed');
    notification.classList.toggle('collapsed');
}

document.addEventListener('DOMContentLoaded', function() {
    function loadContent(page, push = true) {
        fetch(page + '.html')
            .then(response => {
                if (!response.ok) throw new Error('Page not found');
                return response.text();
            })
            .then(html => {
                document.getElementById('main-content').innerHTML = html;
                if (push) {
                    history.pushState({page: page}, '', '#' + page);
                }
            })
            .catch(() => {
                document.getElementById('main-content').innerHTML = '<h2>Page not found</h2>';
            });
    }

    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const content = btn.getAttribute('data-content');
            loadContent(content);
        });
    });

    window.addEventListener('popstate', function(event) {
        const page = location.hash.replace('#', '') || 'home';
        loadContent(page, false);
    });

    const initialPage = location.hash.replace('#', '') || 'home';
    if (initialPage !== 'home') {
        loadContent(initialPage, false);
    }
});