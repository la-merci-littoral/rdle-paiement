console.log('Verifying your stuff :)')

function verifySIREN(apiKey, SIREN) {
    const url = `https://api.insee.fr/entreprises/sirene/V3/siren/${SIREN}`;

    const headers = new Headers({
        'Accept': 'application/json',
        'Authorization': `Bearer ${apiKey}`
    });

    fetch(url, {headers})
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error))
}

function verifySIRET(apiKey, SIRET) {
    const url = `https://api.insee.fr/entreprises/sirene/V3/siren/${SIRET}`;

    const headers = new Headers({
        'Accept': 'application/json',
        'Authorization': `Bearer ${apiKey}`
    });

    fetch(url, {headers})
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error))
}
