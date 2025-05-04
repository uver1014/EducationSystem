function removeBanner(element, id) {
    if (confirm('このバナーを削除しますか？')) {
        const bannerItem = element.parentNode.parentNode;
        const deleteInput = bannerItem.querySelector('.deleted-input');
        deleteInput.value = id;
        bannerItem.style.display = 'none';
    }
}

function removeNewBanner(element) {
    const bannerItem = element.parentNode.parentNode;
    bannerItem.remove();
}

document.addEventListener('DOMContentLoaded', function() {
    const newBannerTemplate = document.getElementById('new-banner-template');
    if (newBannerTemplate) {
        newBannerTemplate.style.display = 'none';
    }

    document.getElementById('add-banner').addEventListener('click', function() {
        const container = document.getElementById('banner-container');
        const template = document.getElementById('new-banner-template').cloneNode(true);
        template.classList.remove('hidden');
        template.classList.add('banner-item', 'p-2', 'd-flex', 'justify-content-center', 'align-items-center');
        container.appendChild(template);
    });
});