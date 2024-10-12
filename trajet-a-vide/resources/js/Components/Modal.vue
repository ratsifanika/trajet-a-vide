<template>
    <div class="modal-overlay">
      <div class="modal-content">
        <slot></slot>
        <button @click="$emit('close')">Annuler</button>
        <button @click="$emit('confirm')">Confirmer</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "Modal",
  };
  </script>
  
  <style>
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
  }
  </style>
  