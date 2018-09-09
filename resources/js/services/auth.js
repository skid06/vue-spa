export function login(credential) {
  console.log('hitting login() from auth.js')
  return new Promise((resolve, reject) => {
    console.log('before axios')
    axios.post('/api/auth/login', credentials)
      .then(response => {
        console.log(response.data)
        resolve(response.data)
      })
      .catch(err => {
        console.log(err)
        reject("Wrong email/password.")
      })
  })
}

export function getLocalUser() {
  const userStr = localStorage.getItem("user");

  if(!userStr) {
    return null;
  }

  return JSON.parse(userStr);
}