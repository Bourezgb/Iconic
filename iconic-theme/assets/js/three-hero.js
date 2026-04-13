/**
 * ICONIC Theme - Three.js Hero Animation
 * Abstract orbital particles animation
 */

(function() {
    'use strict';

    // Check if Three.js is available
    if (typeof THREE === 'undefined') {
        console.log('Three.js not loaded, skipping hero animation');
        return;
    }

    document.addEventListener('DOMContentLoaded', function() {
        initHeroAnimation();
    });

    function initHeroAnimation() {
        const canvas = document.getElementById('hero-canvas');
        if (!canvas) return;

        // Scene setup
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ 
            canvas: canvas, 
            alpha: true, 
            antialias: true 
        });

        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

        // Create particles
        const particlesGeometry = new THREE.BufferGeometry();
        const particlesCount = 2000;
        
        const positions = new Float32Array(particlesCount * 3);
        const colors = new Float32Array(particlesCount * 3);

        for (let i = 0; i < particlesCount * 3; i += 3) {
            // Position - spherical distribution
            const radius = Math.random() * 2 + 1;
            const theta = Math.random() * Math.PI * 2;
            const phi = Math.acos(2 * Math.random() - 1);

            positions[i] = radius * Math.sin(phi) * Math.cos(theta);
            positions[i + 1] = radius * Math.sin(phi) * Math.sin(theta);
            positions[i + 2] = radius * Math.cos(phi);

            // Colors - gradient from cyan to violet
            const colorMix = Math.random();
            colors[i] = colorMix * 0 + (1 - colorMix) * 0.48;     // R
            colors[i + 1] = colorMix * 0.85 + (1 - colorMix) * 0.18; // G
            colors[i + 2] = colorMix * 1 + (1 - colorMix) * 1;    // B
        }

        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        particlesGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

        // Material
        const particlesMaterial = new THREE.PointsMaterial({
            size: 0.02,
            vertexColors: true,
            transparent: true,
            opacity: 0.8,
            blending: THREE.AdditiveBlending
        });

        // Points
        const particles = new THREE.Points(particlesGeometry, particlesMaterial);
        scene.add(particles);

        // Create orbital rings
        const ringsGroup = new THREE.Group();
        
        for (let i = 0; i < 3; i++) {
            const ringGeometry = new THREE.TorusGeometry(1.5 + i * 0.5, 0.005, 16, 100);
            const ringMaterial = new THREE.MeshBasicMaterial({
                color: i === 0 ? 0x00d9ff : (i === 1 ? 0x7b2fff : 0xff006e),
                transparent: true,
                opacity: 0.3
            });
            const ring = new THREE.Mesh(ringGeometry, ringMaterial);
            ring.rotation.x = Math.random() * Math.PI;
            ring.rotation.y = Math.random() * Math.PI;
            ringsGroup.add(ring);
        }

        scene.add(ringsGroup);

        // Camera position
        camera.position.z = 4;

        // Mouse interaction
        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;

        const windowHalfX = window.innerWidth / 2;
        const windowHalfY = window.innerHeight / 2;

        document.addEventListener('mousemove', function(event) {
            mouseX = (event.clientX - windowHalfX) * 0.001;
            mouseY = (event.clientY - windowHalfY) * 0.001;
        });

        // Animation loop
        const clock = new THREE.Clock();

        function animate() {
            requestAnimationFrame(animate);

            const elapsedTime = clock.getElapsedTime();

            // Smooth mouse movement
            targetX += (mouseX - targetX) * 0.05;
            targetY += (mouseY - targetY) * 0.05;

            // Rotate particles
            particles.rotation.y += 0.001;
            particles.rotation.x += 0.0005;

            // Add subtle mouse-based rotation
            particles.rotation.y += targetX * 0.5;
            particles.rotation.x += targetY * 0.5;

            // Rotate rings
            ringsGroup.rotation.y += 0.002;
            ringsGroup.rotation.x += 0.001;

            // Gentle wave motion for particles
            const positions = particlesGeometry.attributes.position.array;
            for (let i = 0; i < particlesCount; i++) {
                const i3 = i * 3;
                positions[i3 + 1] += Math.sin(elapsedTime + positions[i3]) * 0.002;
            }
            particlesGeometry.attributes.position.needsUpdate = true;

            renderer.render(scene, camera);
        }

        animate();

        // Handle resize
        window.addEventListener('resize', function() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        // Performance optimization - pause when not visible
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                // Could pause animation here
            }
        });
    }
})();
