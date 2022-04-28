import { Injectable } from '@angular/core';
import { MiaNewsletter } from '../entities/mia_newsletter';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaNewsletterService extends MiaBaseCrudHttpService<MiaNewsletter> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_newsletter';
  }
 
}