import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import { URL, fileURLToPath } from 'url';

const rootDirPath = fileURLToPath(path.dirname(import.meta.url));

// https://vitejs.dev/config/
export default defineConfig({
	plugins: [vue()],
	resolve: {
		alias: {
			'@': path.join(rootDirPath, 'src'),
		},
	},
});
