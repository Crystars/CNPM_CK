function get_value_by_maxe(select) {
    let tmp = select.value.split('/');
    document.getElementById('maNCC').value = tmp[1];
    document.getElementById('dongia').value = tmp[2];
}