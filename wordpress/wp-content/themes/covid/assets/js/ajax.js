const sendMessageButton = document.getElementById('send-message-button')
const messageEmailInput = document.getElementById('message-email')
const messageTextInput = document.getElementById('message-text')
sendMessageButton.addEventListener('click', () => {
    let ajax = new XMLHttpRequest()
    ajax.open('POST', '/wp-admin/admin-ajax.php?action=request_help', true)
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    ajax.send(`email=${messageEmailInput.value}&text=${messageTextInput.value}`)
})