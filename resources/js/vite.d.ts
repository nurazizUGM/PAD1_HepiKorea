declare interface ImportMeta {
    glob: (path: string, options?: { eager?: boolean }) => Record<string, any>;
    env: Record<string, string>;
}

declare module "*.vue" {
    import { DefineComponent } from "vue";
    const component: DefineComponent<{}, {}, any>;
    export default component;
}
