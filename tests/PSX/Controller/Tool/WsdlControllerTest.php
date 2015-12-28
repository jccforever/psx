<?php
/*
 * PSX is a open source PHP framework to develop RESTful APIs.
 * For the current version and informations visit <http://phpsx.org>
 *
 * Copyright 2010-2015 Christoph Kappestein <k42b3.x@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace PSX\Controller\Tool;

use DOMDocument;
use PSX\Json;
use PSX\Test\ControllerTestCase;

/**
 * WsdlControllerTest
 *
 * @author  Christoph Kappestein <k42b3.x@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class WsdlControllerTest extends ControllerTestCase
{
    public function testIndex()
    {
        $response = $this->sendRequest('http://127.0.0.1/wsdl/1/api', 'GET');
        $xml      = (string) $response->getBody();

        $expect = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<wsdl:definitions xmlns:xs="http://www.w3.org/2001/XMLSchema" name="Api" targetNamespace="http://phpsx.org/2014/data" xmlns:tns="http://phpsx.org/2014/data" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/">
  <wsdl:types xmlns:xs="http://www.w3.org/2001/XMLSchema">
    <xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema" targetNamespace="http://phpsx.org/2014/data" elementFormDefault="qualified" xmlns:tns="http://phpsx.org/2014/data">
      <xs:element name="getRequest" type="tns:void"/>
      <xs:element name="getResponse">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="entry" type="tns:type993f4bb37f524889fc963fedd6381458" minOccurs="0" maxOccurs="unbounded"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:complexType name="type993f4bb37f524889fc963fedd6381458">
        <xs:sequence>
          <xs:element name="id" type="xs:integer" minOccurs="0" maxOccurs="1"/>
          <xs:element name="userId" type="xs:integer" minOccurs="0" maxOccurs="1"/>
          <xs:element name="title" type="tns:type69981114cb5d0f6f81cb98d20181187a" minOccurs="0" maxOccurs="1"/>
          <xs:element name="date" type="xs:dateTime" minOccurs="0" maxOccurs="1"/>
        </xs:sequence>
      </xs:complexType>
      <xs:simpleType name="type69981114cb5d0f6f81cb98d20181187a">
        <xs:restriction base="xs:string">
          <xs:minLength value="3"/>
          <xs:maxLength value="16"/>
          <xs:pattern value="[A-z]+"/>
        </xs:restriction>
      </xs:simpleType>
      <xs:element name="postRequest">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="id" type="xs:integer" minOccurs="0" maxOccurs="1"/>
            <xs:element name="userId" type="xs:integer" minOccurs="0" maxOccurs="1"/>
            <xs:element name="title" type="tns:type25927bd8a7b80c1d8fc520de123ae19a" minOccurs="1" maxOccurs="1"/>
            <xs:element name="date" type="xs:dateTime" minOccurs="1" maxOccurs="1"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:simpleType name="type25927bd8a7b80c1d8fc520de123ae19a">
        <xs:restriction base="xs:string">
          <xs:minLength value="3"/>
          <xs:maxLength value="16"/>
          <xs:pattern value="[A-z]+"/>
        </xs:restriction>
      </xs:simpleType>
      <xs:element name="postResponse">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="success" type="xs:boolean" minOccurs="0" maxOccurs="1"/>
            <xs:element name="message" type="xs:string" minOccurs="0" maxOccurs="1"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:element name="putRequest">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="id" type="xs:integer" minOccurs="1" maxOccurs="1"/>
            <xs:element name="userId" type="xs:integer" minOccurs="0" maxOccurs="1"/>
            <xs:element name="title" type="tns:type69981114cb5d0f6f81cb98d20181187a" minOccurs="0" maxOccurs="1"/>
            <xs:element name="date" type="xs:dateTime" minOccurs="0" maxOccurs="1"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:element name="putResponse">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="success" type="xs:boolean" minOccurs="0" maxOccurs="1"/>
            <xs:element name="message" type="xs:string" minOccurs="0" maxOccurs="1"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:element name="deleteRequest">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="id" type="xs:integer" minOccurs="1" maxOccurs="1"/>
            <xs:element name="userId" type="xs:integer" minOccurs="0" maxOccurs="1"/>
            <xs:element name="title" type="tns:type69981114cb5d0f6f81cb98d20181187a" minOccurs="0" maxOccurs="1"/>
            <xs:element name="date" type="xs:dateTime" minOccurs="0" maxOccurs="1"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:element name="deleteResponse">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="success" type="xs:boolean" minOccurs="0" maxOccurs="1"/>
            <xs:element name="message" type="xs:string" minOccurs="0" maxOccurs="1"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:element name="patchRequest">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="id" type="xs:integer" minOccurs="1" maxOccurs="1"/>
            <xs:element name="userId" type="xs:integer" minOccurs="0" maxOccurs="1"/>
            <xs:element name="title" type="tns:type69981114cb5d0f6f81cb98d20181187a" minOccurs="0" maxOccurs="1"/>
            <xs:element name="date" type="xs:dateTime" minOccurs="0" maxOccurs="1"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:element name="patchResponse">
        <xs:complexType>
          <xs:sequence>
            <xs:element name="success" type="xs:boolean" minOccurs="0" maxOccurs="1"/>
            <xs:element name="message" type="xs:string" minOccurs="0" maxOccurs="1"/>
          </xs:sequence>
        </xs:complexType>
      </xs:element>
      <xs:complexType name="fault">
        <xs:sequence>
          <xs:element name="success" type="xs:boolean" minOccurs="1" maxOccurs="1"/>
          <xs:element name="title" type="xs:string" minOccurs="0" maxOccurs="1"/>
          <xs:element name="message" type="xs:string" minOccurs="1" maxOccurs="1"/>
          <xs:element name="trace" type="xs:string" minOccurs="0" maxOccurs="1"/>
          <xs:element name="context" type="xs:string" minOccurs="0" maxOccurs="1"/>
        </xs:sequence>
      </xs:complexType>
      <xs:complexType name="void">
        <xs:sequence/>
      </xs:complexType>
      <xs:element name="error" type="tns:fault"/>
    </xs:schema>
  </wsdl:types>
  <wsdl:message name="getCollectionInput">
    <wsdl:part name="body" element="tns:getRequest"/>
  </wsdl:message>
  <wsdl:message name="getCollectionOutput">
    <wsdl:part name="body" element="tns:getResponse"/>
  </wsdl:message>
  <wsdl:message name="postItemInput">
    <wsdl:part name="body" element="tns:postRequest"/>
  </wsdl:message>
  <wsdl:message name="postItemOutput">
    <wsdl:part name="body" element="tns:postResponse"/>
  </wsdl:message>
  <wsdl:message name="putItemInput">
    <wsdl:part name="body" element="tns:putRequest"/>
  </wsdl:message>
  <wsdl:message name="putItemOutput">
    <wsdl:part name="body" element="tns:putResponse"/>
  </wsdl:message>
  <wsdl:message name="deleteItemInput">
    <wsdl:part name="body" element="tns:deleteRequest"/>
  </wsdl:message>
  <wsdl:message name="deleteItemOutput">
    <wsdl:part name="body" element="tns:deleteResponse"/>
  </wsdl:message>
  <wsdl:message name="patchItemInput">
    <wsdl:part name="body" element="tns:patchRequest"/>
  </wsdl:message>
  <wsdl:message name="patchItemOutput">
    <wsdl:part name="body" element="tns:patchResponse"/>
  </wsdl:message>
  <wsdl:message name="faultOutput">
    <wsdl:part name="body" element="tns:error"/>
  </wsdl:message>
  <wsdl:portType name="ApiPortType">
    <wsdl:operation name="getCollection">
      <wsdl:input message="tns:getCollectionInput"/>
      <wsdl:output message="tns:getCollectionOutput"/>
      <wsdl:fault message="tns:faultOutput" name="SoapFaultException"/>
    </wsdl:operation>
    <wsdl:operation name="postItem">
      <wsdl:input message="tns:postItemInput"/>
      <wsdl:output message="tns:postItemOutput"/>
      <wsdl:fault message="tns:faultOutput" name="SoapFaultException"/>
    </wsdl:operation>
    <wsdl:operation name="putItem">
      <wsdl:input message="tns:putItemInput"/>
      <wsdl:output message="tns:putItemOutput"/>
      <wsdl:fault message="tns:faultOutput" name="SoapFaultException"/>
    </wsdl:operation>
    <wsdl:operation name="deleteItem">
      <wsdl:input message="tns:deleteItemInput"/>
      <wsdl:output message="tns:deleteItemOutput"/>
      <wsdl:fault message="tns:faultOutput" name="SoapFaultException"/>
    </wsdl:operation>
    <wsdl:operation name="patchItem">
      <wsdl:input message="tns:patchItemInput"/>
      <wsdl:output message="tns:patchItemOutput"/>
      <wsdl:fault message="tns:faultOutput" name="SoapFaultException"/>
    </wsdl:operation>
  </wsdl:portType>
  <wsdl:binding name="ApiBinding" type="tns:ApiPortType">
    <soap:binding style="document" transport="http://schemas.xmlsoap.org/soap/http"/>
    <wsdl:operation name="getCollection">
      <soap:operation soapAction="http://phpsx.org/2014/data/getCollection#GET"/>
      <wsdl:input>
        <soap:body use="literal"/>
      </wsdl:input>
      <wsdl:output>
        <soap:body use="literal"/>
      </wsdl:output>
      <wsdl:fault name="SoapFaultException">
        <soap:body use="literal" name="SoapFaultException"/>
      </wsdl:fault>
    </wsdl:operation>
    <wsdl:operation name="postItem">
      <soap:operation soapAction="http://phpsx.org/2014/data/postItem#POST"/>
      <wsdl:input>
        <soap:body use="literal"/>
      </wsdl:input>
      <wsdl:output>
        <soap:body use="literal"/>
      </wsdl:output>
      <wsdl:fault name="SoapFaultException">
        <soap:body use="literal" name="SoapFaultException"/>
      </wsdl:fault>
    </wsdl:operation>
    <wsdl:operation name="putItem">
      <soap:operation soapAction="http://phpsx.org/2014/data/putItem#PUT"/>
      <wsdl:input>
        <soap:body use="literal"/>
      </wsdl:input>
      <wsdl:output>
        <soap:body use="literal"/>
      </wsdl:output>
      <wsdl:fault name="SoapFaultException">
        <soap:body use="literal" name="SoapFaultException"/>
      </wsdl:fault>
    </wsdl:operation>
    <wsdl:operation name="deleteItem">
      <soap:operation soapAction="http://phpsx.org/2014/data/deleteItem#DELETE"/>
      <wsdl:input>
        <soap:body use="literal"/>
      </wsdl:input>
      <wsdl:output>
        <soap:body use="literal"/>
      </wsdl:output>
      <wsdl:fault name="SoapFaultException">
        <soap:body use="literal" name="SoapFaultException"/>
      </wsdl:fault>
    </wsdl:operation>
    <wsdl:operation name="patchItem">
      <soap:operation soapAction="http://phpsx.org/2014/data/patchItem#PATCH"/>
      <wsdl:input>
        <soap:body use="literal"/>
      </wsdl:input>
      <wsdl:output>
        <soap:body use="literal"/>
      </wsdl:output>
      <wsdl:fault name="SoapFaultException">
        <soap:body use="literal" name="SoapFaultException"/>
      </wsdl:fault>
    </wsdl:operation>
  </wsdl:binding>
  <wsdl:service name="ApiService">
    <wsdl:port name="ApiPort" binding="tns:ApiBinding">
      <soap:address location="http://127.0.0.1/api"/>
    </wsdl:port>
  </wsdl:service>
</wsdl:definitions>
XML;

        $this->assertEquals(null, $response->getStatusCode(), $xml);
        $this->assertEquals('text/xml', $response->getHeader('Content-Type'), $xml);
        $this->assertXmlStringEqualsXmlString($expect, $xml, $xml);
    }

    public function testWsdlSchema()
    {
        $response = $this->sendRequest('http://127.0.0.1/wsdl/1/api', 'GET');
        $wsdl     = (string) $response->getBody();

        $dom = new DOMDocument();
        $dom->loadXML($wsdl);

        $result = $dom->schemaValidate(__DIR__ . '/../../Api/Resource/Generator/Wsdl/wsdl1.xsd');

        $this->assertTrue($result);
    }

    protected function getPaths()
    {
        return array(
            [['GET'], '/wsdl/:version/*path', 'PSX\Controller\Tool\WsdlGeneratorController'],
            [['GET', 'POST', 'PUT', 'DELETE'], '/api', 'PSX\Controller\Foo\Application\TestSchemaApiController'],
        );
    }
}
