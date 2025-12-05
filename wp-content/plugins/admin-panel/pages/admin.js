(function(){
    const navButtons = document.querySelectorAll('.nav button');
    const tabs = document.querySelectorAll('.tab');
  
    function show(id){
      tabs.forEach(t => { t.style.display = (t.id === id) ? '' : 'none'; });
      navButtons.forEach(b=> b.classList.toggle('active', b.dataset.target === id));
    }
  
    navButtons.forEach(btn=> btn.addEventListener('click', ()=> show(btn.dataset.target)));
  
    // Expose small helpers for demo
    window.saveSettings = function(){
      const data = new FormData(document.getElementById('settingsForm'));
      const obj = {};
      for (let [k,v] of data.entries()) obj[k]=v;
      alert('Settings saved (demo)\n' + JSON.stringify(obj, null, 2));
    }
    window.resetForm = function(){ document.getElementById('settingsForm').reset(); }
    window.exportSettings = function(){ alert('Exported settings (demo)'); }
  
  })();