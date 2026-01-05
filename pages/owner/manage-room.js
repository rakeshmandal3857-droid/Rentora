const tableWrapper = document.querySelector('.table-wrapper');

tableWrapper.addEventListener('click', (e)=>{
    // console.log(e.target.closest('button'));
    if(e.target.closest('button') && e.target.closest('button').classList.contains('plus')){
        const tr = e.target.closest('tr');
        const bedCount = Number(tr.querySelector('.bedCount').textContent);
        const occupiedBed = tr.querySelector('.occupied-bed-count');
        const occupiedBedInput = tr.querySelector('.Ocupied-bed');
        if(Number(occupiedBed.textContent) < bedCount){
            occupiedBed.textContent = Number(occupiedBed.textContent) + 1;
            occupiedBedInput.value = Number(occupiedBed.textContent);
        }else{
            showToastNotification('warning', "All beds in this room are currently occupied.");
        }
    }else if(e.target.closest('button') && e.target.closest('button').classList.contains('minus')){
        const tr = e.target.closest('tr');
        const bedCount = Number(tr.querySelector('.bedCount').textContent);
        const occupiedBed = tr.querySelector('.occupied-bed-count');
        const occupiedBedInput = tr.querySelector('.Ocupied-bed');
        if(Number(occupiedBed.textContent) > 0){
            occupiedBed.textContent = Number(occupiedBed.textContent) - 1;
            occupiedBedInput.value = Number(occupiedBed.textContent);
        }else{
            showToastNotification('warning', "This room is fully available.");
        }
    }
})