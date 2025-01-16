import {
    Group,
    Object3D,
    Mesh,
    PerspectiveCamera,
    RectAreaLight,
    Scene,
    WebGLRenderer,
    PlaneGeometry,
    TextureLoader,
    DoubleSide,
    MeshStandardMaterial,
} from 'three';
import { ArcballControls } from 'three/examples/jsm/controls/ArcballControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { RectAreaLightUniformsLib } from 'three/examples/jsm/lights/RectAreaLightUniformsLib.js';
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { GlitchPass } from 'three/examples/jsm/postprocessing/GlitchPass.js';
import { OutputPass } from 'three/examples/jsm/postprocessing/OutputPass.js';

/** @type {HTMLCanvasElement} */
const canvas = document.querySelector('#canvas');
const renderer = new WebGLRenderer({ canvas, antialias: true });

RectAreaLightUniformsLib.init();

const scene = new Scene();

const camera = new PerspectiveCamera();
camera.position.set(0, 0, 9);

const composer = new EffectComposer(renderer);
composer.setPixelRatio(window.devicePixelRatio);
composer.addPass(new RenderPass(scene, camera));

const glitchPass = new GlitchPass();
glitchPass.enabled = false;
glitchPass.goWild = true;
composer.addPass(glitchPass);

const outputPass = new OutputPass();
composer.addPass(outputPass);

export const controls = new ArcballControls(camera, canvas);

export const light = new RectAreaLight(0xffffff, 0, 4, 4);
light.position.set(0, 0.5, 3);
light.rotation.x = -0.3;
scene.add(light);

renderer.setAnimationLoop(update);

export function glitch() {
    glitchPass.enabled = true;
}

function update() {
    handleResize();

    composer.render();
}

const [coffinShellRef, coffinLidRef] = await loadCoffinModel();

const textureLoader = new TextureLoader();

const roughnessMap = await textureLoader.loadAsync('./assets/roughness.avif');

export function createCoffin() {
    const coffin = new Group();
    coffin.position.set(0.06, -0.1, 0);
    coffin.rotation.set(0, Math.PI / -2, 0);

    const [coffinShell, coffinLid] = [coffinShellRef.clone(), coffinLidRef.clone()];
    coffin.add(coffinShell, coffinLid);

    const imageFrame = new Mesh(
        new PlaneGeometry(1.2, 1.2),
        new MeshStandardMaterial({ side: DoubleSide }),
    );
    imageFrame.name = 'imageFrame';
    imageFrame.position.set(-1.5, 1.14, 0.07);
    imageFrame.rotateY(Math.PI / 2);
    imageFrame.rotateX(-Math.PI / 2);
    coffin.add(imageFrame);

    coffin.traverse(node => {
        if (node instanceof Mesh && node.material instanceof MeshStandardMaterial) {
            node.material.roughness = 0.8;
            node.material.roughnessMap = roughnessMap;
        }
    });

    scene.add(coffin);

    return coffin;
}

export const defaultImage = await textureLoader.loadAsync('./assets/default.png');
renderer.initTexture(defaultImage);

export async function loadImage(imageUrl) {
    const image = await textureLoader.loadAsync(imageUrl);
    renderer.initTexture(image);

    return image;
}

export function setImageFrame(coffin, image) {
    const imageFrame = coffin.getObjectByName('imageFrame');
    imageFrame.material.map = image;
    imageFrame.material.needsUpdate = true;
}

export async function createEmptyCoffin() {
    const coffin = createCoffin();
    coffin.getObjectByName('lid_phongE4_0').visible = false;
    coffin.getObjectByName('imageFrame').visible = false;
    scene.add(coffin);

    return coffin;
}

/** @return {Promise<[Object3D, Mesh]>} */
async function loadCoffinModel() {
    const gltfLoader = new GLTFLoader().setPath('./assets/coffin/');
    const model = await gltfLoader.loadAsync('scene.gltf');

    let coffinShell, lid;

    model.scene.traverse(node => {
        if (node.name == 'coffin') {
            coffinShell = node;
        }

        if (node.name == 'lid_phongE4_0') {
            lid = node;
        }
    });

    coffinShell.traverse(node => {
        if (node.isMesh) {
            node.geometry.center();
        }
    });

    lid.geometry.center();
    lid.position.set(0, 1, 0.074);

    return [coffinShell, lid];
}

function handleResize() {
    const displayWidth = window.innerWidth;
    const displayHeight = window.innerHeight;

    const needResize = canvas.width !== displayWidth || canvas.height !== displayHeight;

    if (needResize) {
        composer.setSize(displayWidth, displayHeight);
        renderer.setSize(displayWidth, displayHeight);

        camera.aspect = displayWidth / displayHeight;
        camera.updateProjectionMatrix();
    }
}
