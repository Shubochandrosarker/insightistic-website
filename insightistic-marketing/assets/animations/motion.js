(() => {
  const frames = document.querySelectorAll('.capture');
  function align(frame) {
    const image = frame.querySelector('img');
    const spot = frame.querySelector('.focus');
    if (!image || !spot || !image.naturalWidth) return;
    const [fx, fy, fw, fh] = (spot.dataset.focus || '').split(',').map(Number);
    if ([fx,fy,fw,fh].some(n => !Number.isFinite(n))) return;
    const cw=frame.clientWidth, ch=frame.clientHeight;
    const scale=Math.min(cw/image.naturalWidth,ch/image.naturalHeight);
    const width=image.naturalWidth*scale, height=image.naturalHeight*scale;
    const left=(cw-width)/2, top=(ch-height)/2;
    Object.assign(spot.style,{left:(left+fx*width)+'px',top:(top+fy*height)+'px',width:(fw*width)+'px',height:(fh*height)+'px'});
  }
  for(const frame of frames){
    const img=frame.querySelector('img');
    if(img.complete)align(frame); else img.addEventListener('load',()=>align(frame),{once:true});
    if('ResizeObserver' in window) new ResizeObserver(()=>align(frame)).observe(frame);
    else window.addEventListener('resize',()=>align(frame));
  }
})();