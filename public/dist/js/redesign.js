document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('validationSummary')?.focus();
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        const sidebar = document.getElementById('sidenavAccordion');
        const syncSidebarState = () => {
            const mobile = window.matchMedia('(max-width: 991.98px)').matches;
            const toggled = document.body.classList.contains('sb-sidenav-toggled');
            sidebarToggle.setAttribute('aria-expanded', String(mobile ? toggled : !toggled));
            if (sidebar) sidebar.inert = mobile ? !toggled : toggled;
        };
        syncSidebarState();
        sidebarToggle.addEventListener('click', () => {
            syncSidebarState();
        });
        window.addEventListener('resize', syncSidebarState);
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && window.matchMedia('(max-width: 991.98px)').matches && document.body.classList.contains('sb-sidenav-toggled')) {
                document.body.classList.remove('sb-sidenav-toggled');
                syncSidebarState();
                sidebarToggle.focus();
            }
        });
    }

    document.querySelectorAll('form').forEach((form) => {
        const method = form.querySelector('input[name="_method"]')?.value?.toLowerCase();
        if (method === 'delete') {
            form.addEventListener('submit', (event) => {
                if (!window.confirm('¿Eliminar este registro? Esta acción no se puede deshacer.')) {
                    event.preventDefault();
                }
            });
        }
        if (form.classList.contains('needs-validation')) {
            form.addEventListener('submit', () => {
                if (!form.checkValidity()) {
                    form.querySelector(':invalid')?.focus();
                }
            });
        }
    });
});
