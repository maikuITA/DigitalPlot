console.log('follow loaded');
// writer's information
const username = document.getElementById("username")
const numFollowers = document.getElementById("numFollowers")
// buttons for following/unfollowing
const follow = document.getElementById('follow')
const unfollow = document.getElementById('unfollow')


// This code runs when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', async () => {

  if (!username || !follow || !unfollow) {
    console.warn('Elementi DOM non trovati');
    return;
  }

  // encodeURIComponent is used to encode the username properly
  const url = '/isFollow/' + encodeURIComponent(username.textContent.trim());

  try {
    // 'response' represents the result of the fetch request;
    // await means that the code will wait for the fetch to complete before proceeding
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Accept': 'application/json'
      }
    });

    // Check if the response is ok (status in the range 200-299)
    if (!response.ok) {
      throw new Error('Errore nella risposta del server');
    }

    // 'result' will contain the JSON data returned by the server (the response body defined in CFollow.php)
    const result = await response.json();

    if (result.me === true) {  // If the user is viewing their own profile there is no need to show follow/unfollow buttons
      follow.classList.add('is-hidden');
      unfollow.classList.add('is-hidden');
    } else if (result.success === true) {
      follow.classList.add('is-hidden');
      unfollow.classList.remove('is-hidden');
    } else {
      follow.classList.remove('is-hidden');
      unfollow.classList.add('is-hidden');
    }
  } catch (error) {
    console.error('Errore nella richiesta:', error);
  }
});


// Event listeners for follow and unfollow buttons



follow.addEventListener('click', async () => {
  // Costruzione dell'URL con parametri
  const url = '/follow/' + encodeURIComponent(username.textContent.trim())

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
      let x = parseInt(numFollowers.textContent) + 1 // it adds 1 to the current number of followers
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
  const url = '/unfollow/' + encodeURIComponent(username.textContent.trim())

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


