"""Vestivise_Marketing URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/1.9/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  url(r'^$', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  url(r'^$', Home.as_view(), name='home')
Including another URLconf
    1. Add an import:  from blog import urls as blog_urls
    2. Import the include() function: from django.conf.urls import url, include
    3. Add a URL to urlpatterns:  url(r'^blog/', include(blog_urls))
"""
from django.conf.urls import url
from django.contrib import admin
from django.views.generic import TemplateView
from router import router
from landing import views

urlpatterns = [
    url(r'^admin/', admin.site.urls),
    url(r'^$', TemplateView.as_view(template_name='index.html')),
    url(r'^subscribe/$', TemplateView.as_view(template_name='landingPage.html'), name='subscribe'),
    url(r'^api/mailChimp$', views.subscribeToMailChimp, name='mailChimpSubscribe'),
    url(r'^demo/$', TemplateView.as_view(template_name='demo.html')),
    url(r'^jsreverse/$', 'django_js_reverse.views.urls_js', name='js_reverse'),

]


urlpatterns+= router.urls
