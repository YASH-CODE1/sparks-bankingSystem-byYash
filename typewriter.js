function typewriterEffect(element, text, delay) {
    let i = 0;
    const type = () => {
        if (i < text.length) {
            element.innerHTML += text[i];
            i++;
            setTimeout(type, delay);
        }
    }
    type();
}

window.onload = function() {
    const typewriterElement = document.querySelector(".typewriter");
    typewriterEffect(typewriterElement, "Developed by Yash Sharma", 100);
}
