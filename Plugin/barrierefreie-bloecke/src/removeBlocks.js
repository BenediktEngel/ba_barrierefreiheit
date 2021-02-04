const { unregisterBlockType } = wp.blocks
 
window.onload = function() {
   unregisterBlockType( 'core/video' );
   unregisterBlockType( 'core/audio' );
   unregisterBlockType( 'core/table' );
  unregisterBlockType( 'core/heading' );
}