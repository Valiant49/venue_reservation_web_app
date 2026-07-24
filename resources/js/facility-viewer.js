import * as THREE from "three";
import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader.js";
import { OrbitControls } from "three/examples/jsm/controls/OrbitControls.js";

/* ---------------- Scene ---------------- */

const scene = new THREE.Scene();
scene.background = new THREE.Color(0xe5e7eb);

/* ---------------- Camera ---------------- */

const camera = new THREE.PerspectiveCamera(
    60,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
);

camera.position.set(0, 5, 15);

/* ---------------- Renderer ---------------- */

const renderer = new THREE.WebGLRenderer({
    antialias: true,
});

renderer.setPixelRatio(window.devicePixelRatio);
renderer.setSize(window.innerWidth, window.innerHeight);

document
    .getElementById("viewer")
    .appendChild(renderer.domElement);

/* ---------------- Controls ---------------- */

const controls = new OrbitControls(camera, renderer.domElement);

controls.enableDamping = true;
controls.dampingFactor = 0.05;

controls.enablePan = true;
controls.enableZoom = true;

controls.minDistance = 5;
controls.maxDistance = 80;

controls.maxPolarAngle = Math.PI / 2;

/* ---------------- Lighting ---------------- */

scene.add(new THREE.AmbientLight(0xffffff, 3));

const sun = new THREE.DirectionalLight(0xffffff, 5);
sun.position.set(20, 30, 20);
scene.add(sun);

/* ---------------- Ground ---------------- */

const ground = new THREE.Mesh(
    new THREE.PlaneGeometry(500, 500),
    new THREE.MeshStandardMaterial({
        color: 0xd6d6d6
    })
);

ground.rotation.x = -Math.PI / 2;
ground.position.y = 0;

scene.add(ground);

/* ---------------- GLB Loader ---------------- */

const loader = new GLTFLoader();

loader.load(

    // "/models/test.glb",
    window.MODEL_PATH,

    (gltf) => {

        const model = gltf.scene;

        scene.add(model);

        model.traverse((child) => {

            if (child.isMesh) {

                child.castShadow = true;
                child.receiveShadow = true;

                if (Array.isArray(child.material)) {

                    child.material.forEach(mat => {

                        mat.side = THREE.DoubleSide;

                    });

                } else {

                    child.material.side = THREE.DoubleSide;

                }

            }

        });

        const box = new THREE.Box3().setFromObject(model);

        const center = box.getCenter(new THREE.Vector3());
        const size = box.getSize(new THREE.Vector3());

        // Center horizontally
        model.position.x -= center.x;
        model.position.z -= center.z;

        // Place the bottom of the model on the ground
        const newBox = new THREE.Box3().setFromObject(model);
        model.position.y -= newBox.min.y;

        const radius = Math.max(size.x, size.y, size.z);

        // Position camera
        camera.position.set(
            radius,
            radius * 0.8,
            radius * 1.6
        );

        // Look at middle of building
        controls.target.set(0, size.y / 2, 0);

        controls.update();

    },

    undefined,

    (error) => {

        console.error(error);

    }

);

/* ---------------- Resize ---------------- */

window.addEventListener("resize", () => {

    camera.aspect = window.innerWidth / window.innerHeight;

    camera.updateProjectionMatrix();

    renderer.setSize(window.innerWidth, window.innerHeight);

});

/* ---------------- Animation ---------------- */

function animate() {

    requestAnimationFrame(animate);

    controls.update();

    renderer.render(scene, camera);

}

animate();
