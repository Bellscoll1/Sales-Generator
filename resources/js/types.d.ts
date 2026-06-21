import { PageProps as InertiaPageProps } from '@inertiajs/core';

declare global {
  interface PageProps extends InertiaPageProps {
    auth?: {
      user?: {
        id: string;
        name: string;
        email: string;
      };
    };
  }
}

export {};
