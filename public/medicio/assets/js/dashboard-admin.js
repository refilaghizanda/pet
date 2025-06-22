document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle
    const mobileSidebarToggle = document.createElement('button');
    mobileSidebarToggle.className = 'mobile-sidebar-toggle d-xl-none btn btn-sm btn-primary';
    mobileSidebarToggle.innerHTML = '<i class="bi bi-list"></i>';
    mobileSidebarToggle.style.position = 'fixed';
    mobileSidebarToggle.style.bottom = '20px';
    mobileSidebarToggle.style.right = '20px';
    mobileSidebarToggle.style.zIndex = '999';
    mobileSidebarToggle.style.borderRadius = '50%';
    mobileSidebarToggle.style.width = '50px';
    mobileSidebarToggle.style.height = '50px';
    mobileSidebarToggle.style.display = 'none';
    
    document.body.appendChild(mobileSidebarToggle);
    
    mobileSidebarToggle.addEventListener('click', function() {
        document.body.classList.toggle('mobile-sidebar-open');
    });
    
    // Show/hide mobile sidebar toggle based on screen size
    function handleResize() {
        if (window.innerWidth < 992) {
            mobileSidebarToggle.style.display = 'flex';
            mobileSidebarToggle.style.alignItems = 'center';
            mobileSidebarToggle.style.justifyContent = 'center';
        } else {
            mobileSidebarToggle.style.display = 'none';
            document.body.classList.remove('mobile-sidebar-open');
        }
    }
    
    window.addEventListener('resize', handleResize);
    handleResize();
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Active menu item highlighting
    const currentPage = window.location.pathname.split('/').pop() || 'admin-dashboard.html';
    const menuItems = document.querySelectorAll('.sidebar-menu li a');
    
    menuItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href === currentPage) {
            item.parentElement.classList.add('active');
        } else {
            item.parentElement.classList.remove('active');
        }
    });
    
    // Sidebar toggle functionality
    const sidebar = document.querySelector('.admin-sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            
            // Store preference in localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
            
            // Update icon
            const icon = this.querySelector('i');
            if (isCollapsed) {
                icon.classList.remove('bi-chevron-left');
                icon.classList.add('bi-chevron-right');
            } else {
                icon.classList.remove('bi-chevron-right');
                icon.classList.add('bi-chevron-left');
            }
        });
    }
    
    // Check localStorage for collapsed state
    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        sidebar.classList.add('collapsed');
        const icon = sidebarToggle.querySelector('i');
        icon.classList.remove('bi-chevron-left');
        icon.classList.add('bi-chevron-right');
    }
    
    // Set current year in footer
    const currentYear = new Date().getFullYear();
    document.getElementById('current-year').textContent = currentYear;
    
    // Sample data for charts (if you want to add charts later)
    const appointmentData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Appointments',
            data: [24, 19, 27, 23, 25, 28],
            backgroundColor: 'rgba(63, 149, 175, 0.2)',
            borderColor: 'rgba(63, 149, 175, 1)',
            borderWidth: 1,
            tension: 0.4
        }]
    };
    
    // You can initialize a chart if you include Chart.js
    if (typeof Chart !== 'undefined') {
        const ctx = document.getElementById('appointmentsChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: appointmentData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
    
    // Notification counter
    const notificationCount = 5; // This would come from your backend
    const notificationBadge = document.createElement('span');
    notificationBadge.className = 'notification-badge';
    notificationBadge.textContent = notificationCount;
    notificationBadge.style.position = 'absolute';
    notificationBadge.style.top = '-5px';
    notificationBadge.style.right = '-5px';
    notificationBadge.style.backgroundColor = '#dc3545';
    notificationBadge.style.color = 'white';
    notificationBadge.style.borderRadius = '50%';
    notificationBadge.style.width = '20px';
    notificationBadge.style.height = '20px';
    notificationBadge.style.display = 'flex';
    notificationBadge.style.alignItems = 'center';
    notificationBadge.style.justifyContent = 'center';
    notificationBadge.style.fontSize = '12px';
    
    const notificationIcon = document.querySelector('.notification-icon');
    if (notificationIcon && notificationCount > 0) {
        notificationIcon.style.position = 'relative';
        notificationIcon.appendChild(notificationBadge);
    }
});