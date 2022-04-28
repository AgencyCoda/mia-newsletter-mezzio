import { MiaModel } from "@agencycoda/mia-core";

export class MiaNewsletter extends MiaModel {
    id: number = 0;
    firstname: string = '';
    lastname: string = '';
    email: string = '';
    phone: string = '';
    data_extra: string = '';
    created_at: string = '';
    updated_at: string = '';
    deleted: number = 0;
    status: number = 0;

}