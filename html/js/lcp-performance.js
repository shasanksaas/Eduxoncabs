// LCP Performance Monitoring - Aggressive Optimization
(function() {
  'use strict';
  
  // Mark start time
  const startTime = performance.now();
  
  // Monitor LCP with detailed logging
  if ('PerformanceObserver' in window) {
    const observer = new PerformanceObserver((list) => {
      for (const entry of list.getEntries()) {
        if (entry.entryType === 'largest-contentful-paint') {
          const lcpTime = Math.round(entry.startTime);
          console.log('🎯 LCP:', lcpTime, 'ms');
          
          // Color coding for performance
          if (lcpTime < 2500) {
            console.log('✅ Excellent LCP performance!');
          } else if (lcpTime < 4000) {
            console.log('⚠️ Good LCP, can be improved');
          } else {
            console.log('❌ Poor LCP, needs optimization');
          }
          
          // Log the LCP element
          if (entry.element) {
            console.log('LCP Element:', entry.element);
          }
        }
      }
    });
    
    try {
      observer.observe({ entryTypes: ['largest-contentful-paint'] });
    } catch (e) {
      console.warn('LCP monitoring not supported');
    }
  }
  
  // Optimize font loading immediately
  if ('fonts' in document) {
    document.fonts.load('400 16px Open Sans').then(() => {
      document.documentElement.classList.add('fonts-loaded');
      console.log('⚡ Fonts loaded:', Math.round(performance.now() - startTime), 'ms');
    });
  }
  
  // Monitor other Core Web Vitals
  if ('PerformanceObserver' in window) {
    // FCP Observer
    const fcpObserver = new PerformanceObserver((list) => {
      for (const entry of list.getEntries()) {
        console.log('🎨 FCP:', Math.round(entry.startTime), 'ms');
      }
    });
    
    try {
      fcpObserver.observe({ entryTypes: ['paint'] });
    } catch (e) {}
  }
  
  // Report loading completion
  window.addEventListener('load', () => {
    console.log('📊 Page Load Complete:', Math.round(performance.now() - startTime), 'ms');
  });
  
})();
