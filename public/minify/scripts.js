let deleteLinks=document.querySelectorAll('.delete-links')
if(deleteLinks){let arrayLinks=[...deleteLinks]
arrayLinks.map((links)=>{links.addEventListener('click',(e)=>{e.preventDefault()
let csrf=document.querySelector('meta[name="csrf-token"]')
let row=e.target.parentNode.parentNode
let hash=e.target.dataset.delete
let url=e.target.dataset.url
const form=new FormData()
form.append('hash',hash)
fetch(url,{headers:{'x-csrf-token':csrf.getAttribute('content')},method:"POST",body:form,}).then((data)=>data.json()).then((data)=>{if(data.error){alert('erro ao deletar o registro')}
if(data.delete){row.style.display='none'}})})})}