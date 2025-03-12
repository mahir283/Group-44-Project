let darkmode = localStorage.getItem('darkmode')
const themeSwitch = document.getElementById('theme-switch')
let image = document.getElementById('BrumBrummLogo')

const enableDarkmode = () => {
    document.body.classList.add('darkmode')
    localStorage.setItem('darkmode', 'active')
    document.getElementById("BrumBrummLogo").src = '/assets/brumdark.png';
}

const disableDarkmode = () => {
    document.body.classList.remove('darkmode')
    localStorage.setItem('darkmode', null)
    document.getElementById("BrumBrummLogo").src = '/assets/brumlight.png';
}

if(darkmode === "active") enableDarkmode()

themeSwitch.addEventListener("click", () => {
    darkmode = localStorage.getItem('darkmode')
    darkmode !== "active" ? enableDarkmode() : disableDarkmode()
})
