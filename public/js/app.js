document.addEventListener('DOMContentLoaded', function() {
    
    const tabs = document.querySelectorAll('[data-tab-target]');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            
            const contents = document.querySelectorAll('[data-tab-content] > div');
            contents.forEach(content => content.classList.add('hidden', 'opacity-0'));

            const targetId = this.getAttribute('data-tab-target');
            const targetContent = document.getElementById(targetId + 'Content');
            if (targetContent) {
                targetContent.classList.remove('hidden', 'opacity-0');
            }
        });
    });
});