const htmlModal = '<div class="modal-box flex-container">'
    + '    <header class="modal-header flex-container">'
    + '        <div class="modal-title"></div>'
    + '        <div class="modal-close"> X </div>'
    + '    </header>'
    + '    <div class="modal-content flex-container">'
    + '    </div>'
    + '    <footer class="flex-container modal-footer">'
    + '        <div class="half-row modal-btn-area"></div>'
    + '        <div class="half-row modal-btn-area"></div>'
    + '    </footer>'
    + '</div>'

const modal =  {
    rootModalElem: document.querySelector('.modal'),
    title: '',
    content: '',
    _btnOk: 'ok',
    _btnCancel: 'cancel',
    _btnConfirm: 'confirm',
    callbackConfirm: null,

    /**
     * btnsAvailable: Array of available buttons
     * [_btnOk, _btnCancel, _btnConfirm]
     */
    render: btnsAvailable => {
        modal.rootModalElem.innerHTML = htmlModal
        modal.rootModalElem.style.display = 'flex'
        document.querySelector('.modal-title').innerHTML = modal.title
        document.querySelector('.modal-content').innerHTML = modal.content

        modal._availableButtons(btnsAvailable)
        modal._binds()
    },

    setTitle: title => {
        modal.title = title
        return modal
    },

    setContent: content => {
        modal.content = content
        return modal
    },

    _binds: () => {
        const btnOk = document.querySelector('.modal-btn-ok')
        const btnCancel = document.querySelector('.modal-btn-cancel')
        const btnConfirm = document.querySelector('.modal-btn-confirm')
        const btnClose = document.querySelector('.modal-close')

        if (btnOk !== null) {
            btnOk.addEventListener('click', e => {
                e.preventDefault()
                modal.rootModalElem.style.display = 'none'
                window.location.href = "/index.php"
            })
        }

        if (btnClose !== null) {
            btnClose.addEventListener('click', e => {
                e.preventDefault()
                modal.rootModalElem.style.display = 'none'
            })
        }

        if (btnCancel !== null) {
            btnCancel.addEventListener('click', e => {
                e.preventDefault()
                modal.rootModalElem.style.display = 'none'
                return false
            })
        }

        if (btnConfirm !== null) {
            btnConfirm.addEventListener('click', e => {
                e.preventDefault()
                modal.rootModalElem.style.display = 'none'
                modal.callbackConfirm()
                return true
            })
        }
    },

    _availableButtons: btns => {
        const areaButtons = document.getElementsByClassName('modal-btn-area')

        if (btns.length > 2) {
            console.error('We can only make two buttons available')
            return
        }

        btns.map(btn => {
            if (btn === 'cancel') {
                areaButtons[0].innerHTML = '<button class="btn btn-cancel modal-btn-cancel">Cancel</button>'
            }

            if (btn === 'ok') {
                areaButtons[1].innerHTML = '<button class="btn btn-save modal-btn-ok">Ok</button>'
            }

            if (btn === 'confirm') {
                areaButtons[1].innerHTML = '<button class="btn btn-save modal-btn-confirm">Confirm</button>'
            }
        })
    },

    setCallbackConfirmButton: func => modal.callbackConfirm = func

}

export default modal