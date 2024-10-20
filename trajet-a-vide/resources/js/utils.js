export const formatDate = (value) => {
    if (!value) return ''
    const date = new Date(value)
    const options = { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' }
    return `${new Intl.DateTimeFormat('fr-FR', options).format(date).replace(',', ' à')}`
}