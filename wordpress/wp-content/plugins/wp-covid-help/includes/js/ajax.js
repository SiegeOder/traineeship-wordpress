const subjectInput = document.getElementById('subject')
const textInput = document.getElementById('text')
const updateButton = document.getElementById('update')
updateButton.addEventListener('click', () => {
    let ajax = new XMLHttpRequest()
    ajax.open('POST', '/wp-admin/admin-ajax.php?action=update_mail', true)
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    ajax.send(`subject=${subjectInput.value}&text=${textInput.value}`)
})