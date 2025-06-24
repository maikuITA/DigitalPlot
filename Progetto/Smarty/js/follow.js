const username = document.getElementById("username")

const follow = document.getElementById('follow')
const unfollow = document.getElementById('unfollow')

follow.addEventListener('click', async () => {
  // Costruzione dell'URL con parametri
  const url = '/follow/' + username.textContent

  try {
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Accept': 'application/json'
      }
    });

    if (!response.ok) {
      throw new Error('Errore nella risposta del server');
    }

    const result = await response.json();

    if (result.success === true) {
      follow.classList.add('is-hidden')
      unfollow.classList.remove('is-hidden')
    }
  } catch (error) {
    console.error('Errore nella richiesta:', error);
  }
});

unfollow.addEventListener('click', async () => {
  // Costruzione dell'URL con parametri
  const url = '/follow/' + username.textContent

  try {
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Accept': 'application/json'
      }
    });

    if (!response.ok) {
      throw new Error('Errore nella risposta del server');
    }

    const result = await response.json();

    if (result.success === true) {
      unfollow.classList.add('is-hidden')
      follow.classList.remove('is-hidden')
    }
  } catch (error) {
    console.error('Errore nella richiesta:', error);
  }
});

