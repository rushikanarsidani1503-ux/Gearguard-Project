function load(){
fetch("api/requests.php")
.then(r=>r.json())
.then(data=>{
document.querySelectorAll('.col').forEach(c=>c.innerHTML="<h3>"+c.id+"</h3>");
data.forEach(r=>{
let d=document.createElement("div");
d.className="card"+(r.overdue?" overdue":"");
d.innerHTML=r.subject+"<br>"+r.equipment;
d.onclick=()=>update(r.id);
document.getElementById(r.stage).appendChild(d);
});
});
}

function update(id){
if(ROLE=="user") return;
let s=prompt("New / In Progress / Repaired / Scrap");
fetch("api/requests.php",{method:"PUT",
body:JSON.stringify({id,stage:s,duration:2})}).then(load);
}

document.getElementById("reqForm")?.addEventListener("submit",e=>{
e.preventDefault();
fetch("api/requests.php",{method:"POST",
body:JSON.stringify({
subject:subject.value,
request_type:type.value,
equipment_id:equipment.value,
scheduled_date:date.value
})}).then(load);
});

load();
