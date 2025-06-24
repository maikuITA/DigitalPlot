const username = document.getElementById("username")
const numFollowers = document.getElementById("numFollowers")
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
      let x = parseInt(numFollowers.textContent) + 1
      numFollowers.textContent = x
      follow.classList.add('is-hidden')
      unfollow.classList.remove('is-hidden')
    }
  } catch (error) {
    console.error('Errore nella richiesta:', error);
  }
});

unfollow.addEventListener('click', async () => {
  // Costruzione dell'URL con parametri
  const url = '/unfollow/' + username.textContent

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
      let x = parseInt(numFollowers.textContent) - 1
      numFollowers.textContent = x
      unfollow.classList.add('is-hidden')
      follow.classList.remove('is-hidden')
    }
  } catch (error) {
    console.error('Errore nella richiesta:', error);
  }
});

document.addEventListener('DOMContentLoaded', async ()=>{
  // Costruzione dell'URL con parametri
  const url = '/isFollow/' + username.textContent

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
    else{
      unfollow.classList.add('is-hidden')
      follow.classList.remove('is-hidden')  
    }
  } catch (error) {
    console.error('Errore nella richiesta:', error);
  }
})

