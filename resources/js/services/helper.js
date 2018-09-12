export function prevAndNext(commit, url) {
  axios.get(url)
  .then(response => {
    console.log(response.data)
    commit('prevAndNext', response.data)
  })
  .catch(err => console.log(err))      
}    