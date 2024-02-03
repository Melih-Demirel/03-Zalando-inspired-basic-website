/**
 * Update the csrf token and hash
 * @param {String} token 
 * @param {String} hash 
 */
 function setCSRF(token, hash) {

    let csrfField = document.getElementById('csrf');
    
    if (csrfField) {
        csrfField.setAttribute('name', token);
        csrfField.setAttribute('value', hash);
    }

    csrfToken = token;
    csrfHash = hash;
}