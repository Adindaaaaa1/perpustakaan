// JavaScript for scroll buttons
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("scrollUpBtn").style.display = "block";
    } else {
        document.getElementById("scrollUpBtn").style.display = "none";
    }
    
    if (document.body.scrollHeight - window.innerHeight - document.documentElement.scrollTop > 20) {
        document.getElementById("scrollDownBtn").style.display = "block";
    } else {
        document.getElementById("scrollDownBtn").style.display = "none";
    }
}

function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function scrollToBottom() {
    window.scrollTo(0, document.body.scrollHeight);
}
