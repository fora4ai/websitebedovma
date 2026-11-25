const btn = document.getElementById('toggleBtn');
const pic = document.getElementById('pic');

btn.addEventListener('click', () => {
  pic.classList.toggle('show');
});
